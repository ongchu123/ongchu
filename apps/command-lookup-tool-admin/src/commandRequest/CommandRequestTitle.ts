import { CommandRequest as TCommandRequest } from "../api/commandRequest/CommandRequest";

export const COMMANDREQUEST_TITLE_FIELD = "id";

export const CommandRequestTitle = (record: TCommandRequest): string => {
  return record.id?.toString() || String(record.id);
};
